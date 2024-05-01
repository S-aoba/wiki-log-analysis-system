<?php

class DB
{

  private string $host = 'db';
  private string $dbname;
  private string $username;
  private string $password;
  private string $dbTablename = 'page_views';

  private const LOAD_FILE_NAME = 'page_view';

  private PDO $pdo;

  public function __construct()
  {
    $this->dbname = $_ENV['MYSQL_DATABASE'];
    $this->username = $_ENV['MYSQL_USER'];
    $this->password = $_ENV['MYSQL_PASSWORD'];


    // データベースに接続する
    $this->connectDB();
  }

  private function checkDataInPageViewTable(): bool
  {
    $query = "SELECT * FROM {$this->dbTablename} LIMIT 1";

    try {
      $stmt = $this->pdo->query($query);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($row) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      echo "エラー: " . $e->getMessage() . PHP_EOL;
    }
  }

  private function connectDB(): void
  {
    try {
      // PDO インスタンスを作成し、MySQL データベースに接続する
      $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password, [PDO::MYSQL_ATTR_LOCAL_INFILE => 1]);

      $this->pdo = $pdo;

      echo "データベースとの接続に成功しました" . PHP_EOL;
    } catch (PDOException $e) {
      // エラーが発生した場合はエラーメッセージを出力する
      echo "エラー: " . $e->getMessage();
    }
  }

  public function createPageViewsTable()
  {
    $query = "CREATE TABLE IF NOT EXISTS page_views (
        domain_code VARCHAR(255),
        page_title VARCHAR(500),
        count_views INT,
        total_response_size INT,
        PRIMARY KEY (domain_code, page_title)
    )";

    try {
      $this->pdo->query($query);
      // クエリの実行が成功したことを示すメッセージを出力する
      echo $this->dbTablename . "テーブルを作成しました" . PHP_EOL;
    } catch (PDOException $e) {
      // エラーが発生した場合は例外をキャッチし、エラーメッセージを出力する
      echo "テーブルの作成に失敗しました: " . $e->getMessage() . PHP_EOL;
    }
  }

  public function overwriteData()
  {
    $query = "TRUNCATE TABLE {$this->dbTablename}";

    try {
      $stmt = $this->pdo->prepare($query);
      $stmt->execute();

      // クエリの実行が成功したことを示すメッセージを出力する
      echo "テーブルをクリアしました" . PHP_EOL;
    } catch (PDOException $e) {
      // エラーが発生した場合は例外をキャッチし、エラーメッセージを出力する
      echo "テーブルのクリアに失敗しました: " . $e->getMessage() . PHP_EOL;
    }
  }

  public function loadDataInPageViews()
  {
    if ($this->checkDataInPageViewTable()) {
      // データを上書きする関数
      $this->overwriteData();
    }

    echo "データのインポートを開始します..." . PHP_EOL;

    $load_file_name = self::LOAD_FILE_NAME;

    $query = "LOAD DATA LOCAL INFILE '/app/databases/{$load_file_name}'
              INTO TABLE page_views
              FIELDS TERMINATED BY ' '";

    try {
      $stmt = $this->pdo->prepare($query);
      $stmt->execute();

      // データの読み込みが成功したことを示すメッセージを出力する
      echo "データのインポートに成功しました" . PHP_EOL;
    } catch (PDOException $e) {
      // エラーが発生した場合は例外をキャッチし、エラーメッセージを出力する
      echo "データのインポートに失敗しました: " . $e->getMessage() . PHP_EOL;
    }
  }
}
