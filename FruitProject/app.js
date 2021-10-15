const mongoose = require('mongoose');
// mongoose.set('useNewUrlParser', true);
// mongoose.set('useUnifiedTopology', true);
// mongoose.connect('mongodb://localhost:27017/fruitsDB');
mongoose.connect("mongodb://localhost:27017/fruitsDB", { useUnifiedTopology: true, useNewUrlParser: true });

const fruitSchema = new mongoose.Schema({
name: {
    type:String,
    required:true
},
rating: {
    type:Number,
    min:1,
    max:10
},
review: {
    type:String,
},
});
const personSchema = new mongoose.Schema({
    name: String,
    age: Number,
    favouriteFruit:fruitSchema
    });

const Fruit = mongoose.model("Fruit",fruitSchema);
const Person = mongoose.model("Person",fruitSchema);

const pineapple = new Fruit({
    name:"Pineapple",
    rating:7,
    review:"Tasty"
});

const person = new Person({
    name:"Amy",
    age:27,
    favouriteFruit:pineapple
});
pineapple.save();
person.save();

mongoose.connection.close();



/*First Practise 

const fruit = new Fruit({
    name:"Apple",
    rating:7,
    review:"Pretty Solid as a fruit."
});

const person = new Person({
    name:"John",
    rating:37,
});
// person.save();


const kiwi = new Fruit({
    name:"Kiwi",
    rating:9,
    review:"Good fruit."
});

const orange = new Fruit({
    name:"Orange",
    rating:8,
    review:"Every now and then"
});

const banana = new Fruit({
    name:"Banana",
    rating:5,
    review:"Weird Texture "
});

// Fruit.insertMany([kiwi,orange,banana], function(err){
//     if(err){
//         console.log(err);
//     }else{
//         console.log("Success");
//     }
// });

// Fruit.find(function(err, fruits){
// if(err){
//     console.log(err);
// }else{
//     mongoose.connection.close();

//     fruits.forEach(fruit => {
//         console.log(fruit['name']);
//     });
// }
// });
*/