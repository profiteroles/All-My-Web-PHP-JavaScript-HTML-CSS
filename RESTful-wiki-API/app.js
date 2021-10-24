const express = require('express');
const bodyParser = require('body-parser');
const ejs = require("ejs");
const mongoose = require('mongoose');

const app = express();



app.set('view engine', 'ejs');

app.use(bodyParser.urlencoded({ extended: true }));

// mongoose.connect("mongodb+srv://admin:admin@cluster0.ejze9.mongodb.net/wikiDB", { useUnifiedTopology: true, useNewUrlParser: true });
mongoose.connect("mongodb://localhost:27017/wikiDB", { useUnifiedTopology: true, useNewUrlParser: true });

const articleSchema = {
    title: String,
    content: String
}

const Article = mongoose.model("Article", articleSchema);

app.route("/articles")

    .get(function (req, res) {
        Article.find({}, function (err, docs) {
            if (!err) {
                res.send(docs);
            } else {
                res.send(err);
            }
        });
    })
    .post(function (req, res) {
        const title = req.body.title;
        const content = req.body.content;
        const newArticle = new Article({
            title: title,
            content: content
        });
        newArticle.save(function (err) {
            if (!err) {
                res.send('Successfully Added to the DB.');
            } else {
                res.send(err);
            }
        });
    })
    .delete(function (req, res) {
        Article.deleteMany(function (err) {
            if (!err) {
                res.send('All the Articles succesfully deleted!');
            } else {
                res.send(err);
            }
        })
    });

app.route('/articles/:slug')
    .get(function (req, res) {

        Article.findOne({ title: req.params.slug }, function (err, article) {
            if (article) {
                res.send(article);
            } else {
                res.send("No articles has found by that slug");
            }
        });
    })
    .put(function (req, res) {
        Article.findOneAndUpdate(
            { title: req.params.slug },
            { title: req.body.title, content: req.body.content },
            { overwrite: true },
            function (err) {
                if (!err) {
                    res.send('Successfully Updated');
                }
            });
    })
    .patch(function (req, res) {
        Article.findOneAndUpdate(
            { title: req.params.slug },
            { $set: req.body },
            function (err) {
                if (!err) {
                    res.send('Successfully updated');
                } else {
                    res.send(err);
                }
            }
        );
    })
    .delete(function (req, res) {
        Article.deleteOne({ title: req.params.slug }, function (err) {
            if (err) {
                res.send(err);
            } else {
                res.send('Successfully deleted!');
            }
        });
    });

app.listen(3000, function () {
    console.log('Server started on port 3000');
});