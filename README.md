# blackjack

コンソール画面上で遊ぶブラックジャックを開発しました。

プレイ人数を増やしCPUとプレイできる機能を開発中。

## 環境構築

```bash
# Docker イメージのビルド
docker-compose build

# Docker コンテナの起動
docker-compose up -d

# Docker コンテナの停止・削除
docker-compose down
```

## 遊び方

```bash
# blackjackディレクトリ内でコマンドを実行
docker-compose exec app php BJMain.php

※プレイヤー人数は1人を選択してください。
```
