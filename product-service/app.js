// product-service/app.js
const express = require('express');
const fs = require('fs');

const app = express();
app.use(express.json());

const filePath = './products.json';

// Initialize JSON file
if (!fs.existsSync(filePath)) {
    fs.writeFileSync(filePath, JSON.stringify([]));
}

app.get('/products', (req, res) => {
    const products = JSON.parse(fs.readFileSync(filePath));
    res.json(products);
});

app.post('/products', (req, res) => {
    const products = JSON.parse(fs.readFileSync(filePath));
    const newProduct = { id: products.length + 1, ...req.body };
    products.push(newProduct);
    fs.writeFileSync(filePath, JSON.stringify(products));
    res.status(201).send(newProduct);
});

app.listen(3002, () => {
    console.log('Product service running on port 3002');
});
