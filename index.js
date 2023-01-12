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

app.get('/cu/:id/:name/:lastname/:birth/:address', 
[
    check('id').custom(Id),
    check('name',).custom(Name),
    check('lastname').custom(LastName),
    check('birth', 'es necesaria una fecha de nacimiento').custom(Birth),
    check('address', 'es necesaria una comuna').custom(Address)
    ],    
async (req, res) => {
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
        const ps=req.params.mod
        await User.findOneAndUpdate(uid[0]._id,{name:req.params.name},{lastname:req.params.lastname},{birth:req.params.birth},{address:req.params.address}, {new:true})
    }
    res.redirect('/')
})
app.get('/cumde/:id',async (req, res) => {
    const ema=req.params.id
    const uid= await User.find({id:ema})
    if(!uid){
        throw new Error(`usuario no existente: ${ema} `)
    }else{
        await User.findByIdAndDelete(uid[0]._id).then(()=>{
            console.log("eliminado");
        })
    }
    res.redirect('/')
})

async function wea(Id){
    const uid= await User.find({id:Id})
    if(!uid){
        throw new Error(`usuario no existente: ${uid} `)
    }else{
        alert('id: '+ uid.id, ' nombre: '+ uid.name+' apellido: '+uid.lastname+' nacimiento: '+uid.birth+' comuna: '+uid.address)
    }
}

app.listen("8082", () => {
    console.log('sus chinanigunz seran aportados atraves del puertito: 8082')
})