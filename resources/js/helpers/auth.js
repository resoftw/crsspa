export function login(credentials){
    return new Promise((res,rej)=>{
        axios.post('/api/auth/login', credentials)
        .then((r)=>{
            res(r.data);
        })
        .catch((err)=>{
            rej("Invalid username or password!");
        })
    })
}

export function getLocalUser(){
    const userStr=localStorage.getItem('user');
    if (!userStr){
        return null;
    }
    return JSON.parse(userStr);
}