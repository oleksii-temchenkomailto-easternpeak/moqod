#Readme

## How to run application

You need docker installed on yor pc.
```bash
docker build -t moqod:latest .
docker run -p 3000:8000 moqod:latest
```

OR you can run app with docker-compose

```bash
docker-compose up
```

Then follow this [link](http://127.0.0.1:3000/rates/).