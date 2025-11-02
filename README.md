# ServiceDesk

Учебный пет-проект

Порядок развёртки

1. Скопировать .env
```bash
cp .env.example .env
```
2. Прописать `DB_PASSWORD` в `.env`

3. Выполнить инструкции
```bash
sudo ./dc up -d
./dc exec -it node npm i && ./dc exec -it app composer i
./dc exec app ./artisan migrate && ./dc exec app ./artisan db:seed
```
