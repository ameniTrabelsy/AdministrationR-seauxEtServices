# client-service/Dockerfile
FROM python:3.9
WORKDIR /app
COPY app.py .
RUN pip install flask
EXPOSE 3001
CMD ["python", "app.py"]
