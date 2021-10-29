require('dotenv').config();
const express = require('express');
const cheerio = require('cheerio');
const axios = require('axios');
const app = express();


const url = "https://www.theguardian.com/au";
axios(url)
    .then(res => {
        const html = res.data;
        const $ = cheerio.load(html);
        const articles = [];

        $('.fc-item__title', html).each(function () {
            const title = $(this).text();
            const titleURL = $(this).find('a').attr('href');
            articles.push({
                title, titleURL
            });
        });

        console.log(articles);
    }).catch(err => console.log(err));


app.listen(process.env.PORT, () => console.log('started'));