require('dotenv').config();
const express = require("express");
const bodyParser = require("body-parser");
const ejs = require('ejs');
const mongoose = require("mongoose");
const session = require('express-session');
const passport = require('passport');
const LocalStrategy = require('passport-local');
const passportLocalMongoose = require('passport-local-mongoose');


const app = express();
app.use(express.static("public"));
app.set('view engine', 'ejs');
app.use(bodyParser.urlencoded({ extended: true }));

app.use(session({
    secret: "My little secret",
    resave: false,
    saveUninitialized: false
}));

app.use(passport.initialize());
app.use(passport.session());


mongoose.connect(process.env.ADMINPATH, { useUnifiedTopology: true, useNewUrlParser: true });
// mongoose.set("useCreateIndex", true);

const userSchema = new mongoose.Schema({
    email: String,
    password: String
});
userSchema.plugin(passportLocalMongoose);

const User = new mongoose.model("User", userSchema);

// passport.use(User.createStrategy());

// app.use(new LocalStrategy(User.authenticate()));
passport.serializeUser(User.serializeUser());
passport.deserializeUser(User.deserializeUser());

app.get('/secrets', function (req, res) {
    if (req.isAuthenticated()) {
        res.render('secrets');
    } else {
        response.redirect('/login');
    }
});

app.get("/", function (req, res) {
    res.render("home");
});

app.route("/register")
    .get(function (req, res) {
        res.render("Register")
    })
    .post(function (req, res) {
        console.log(req.body.username);
        console.log(req.body.password);


        User.register({ username: req.body.username }, req.body.password, function (err, user) {
            if (err) {
                console.log(err);
                res.redirect('/register');
            } else {
                passport.authenticate('local')(req, res, function () {
                    res.redirect('/secrets');
                });
            }
        });
    });

app.route("/login")
    .get(
        function (req, res) {
            res.render("Login");
        })
    .post(function (req, res) {
        const username = req.body.username;
        const password = req.body.password;

        req.login(user, function (err) {
            if (err) {
                console.log(err);
            } else {
                passport.authenticate('local')(req, res, function () {
                    res.redirect('/secrets');
                });
            }
        });
    });

app.get('/logout', function (req, res) {
    req.logOut();
    res.redirect('/');
});

let port = process.env.PORT;

if (port == null || port == "") {
    port = 3000;
}

app.listen(port, function () {
    console.log('Server has Started on port: ' + port);
});
