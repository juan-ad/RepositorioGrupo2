const Id=async(id='')=>{
    if(id==''){
        throw new Error(`id no valido: ${id} `)
    }
}

const Name=async(name='')=>{
    if(name==''){
        throw new Error(`nombre no valido: ${name} `)
    }
}
const LastName=async(lastname='')=>{
    if(lastname==''){
        throw new Error(`apellido no valido: ${lastname} `)
    }
}
const Birth=async(birth='')=>{
    if(birth==''){
        throw new Error(`fecha no valida: ${birth} `)
    }
}
const Address=async(address='')=>{
    if(address==''){
        throw new Error(`direccion no valido: ${address} `)
    }
}

module.exports={Id, Name, LastName, Birth,Address}