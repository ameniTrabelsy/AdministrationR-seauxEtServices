# product-service/Dockerfile
FROM node:14
WORKDIR /app
COPY app.js .
RUN npm install express
EXPOSE 3002
CMD ["node", "app.js"]
