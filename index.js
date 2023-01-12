const mongoose = require("mongoose")
const express = require('express');
const User =require('./user')
const { check } = require('express-validator');
const {Id, Name, LastName, Birth,Address} = require('./db-validator')

try {
    mongoose.connect('mongodb+srv://admin:1234@cluster0.kfowgwb.mongodb.net/database', {
        useNewUrlParser:true,
        useUnifiedTopology:true
    })
    console.log("ESTA VIVAAAAAAAAA!!!!!!!!!")
} catch (error) {
    console.log("sumakina da error nmm: ",error)
    throw new Error("sumakina da error nmm")
}

const app = express()
app.use(express.static('public'))
app.use(express.json())

app.get('/cu/:id/:name/:lastname/:birth/:address',async (req, res) => {
    const r=new User({
        id:req.params.id,
        name:req.params.name,
        lastname:req.params.lastname,
        birth:req.params.birth,
        address:req.params.address,
    })
    await r.save()
    .then(() =>{
        console.log("YES")
        res.redirect('/')
    })
    .catch(err => {
        console.log("NOPE")
        console.log(err);
    });
    
})

app.get('/cumd/:id/:name/:lastname/:birth/:address',async (req, res) => {
    const uid= await User.find({id:req.params.id})
    if(!uid){
            throw new Error(`usuario no existente: ${uid} `)
    }else{
        await User.findOneAndUpdate(uid[0]._id,{name:req.params.name},{lastname:req.params.lastname})
        await User.findOneAndUpdate(uid[0]._id,{birth:req.params.birth},{address:req.params.address})
    }
    res.redirect('/')
})


app.get('/cude/:id',async (req, res) => {
    const ema=req.params.id
    const uid= await User.find({id:ema})
    if(!uid){
        res.status(404).json(`usuario no existente: ${uid} `)
    }else{
        await User.findByIdAndDelete(uid[0]._id).then(()=>{
            console.log("eliminado");
        })
    }
    res.redirect('/')
})

app.get('/cuinfo/:id',async (req, res) => {
    const uid= await User.find({id:req.params.id})
    if(uid.length<=0){
        res.status(404).json(`usuario no existente: ${uid} `)
    }else{
        res.json(uid[0])
    }
})

app.listen("8082", () => {
    console.log('sus chinanigunz seran aportados atraves del puertito: 8082')
})