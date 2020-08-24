
## How to run application

You need docker installed on yor pc.
```bash
docker build -t moqod:latest .
docker run -p 3000:8000 moqod:latest
```

OR you can run app with docker-compose

```bash
cp docker-compose.yml.example docker-compose.yml
docker-compose up
```

Then follow this [link](http://127.0.0.1:3000/rates/).
Or link [link](http://127.0.0.1:3000/rates/RUB) for changing base currency.