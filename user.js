const { Schema, model} = require("mongoose")

const User=Schema({
    id:{
        type: Number,
        require:true,
        unique:true
    },
    name:{
        type: String,
        require:true
    },
    lastname:{
        type: String,
        require:true
    },
    brith:{
        type: String,
        require:true
    },
    address:{
        type: Number,
        require:true
    },
})

module.exports=model('Usuario', User)