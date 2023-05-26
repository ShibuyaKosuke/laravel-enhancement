# laravel-enhancement

ファイルをローカルにコピーする

```bash
git clone git@github.com:ShibuyaKosuke/laravel-enhancement.git
```

Git の履歴を削除する

```bash
cd laravel-enhancement
rm -rf .git
```

laravel-enhancement という名前でGithub にリポジトリを作成する。

```bash
cd laravel-enhancement
git init
git add .
git commit -m "first commit"
git branch -M main
git remote add origin
```

Github Action の設定

Settings > Actions > General > 「Workflow permissions」で「Read and write permissions」を選択する。