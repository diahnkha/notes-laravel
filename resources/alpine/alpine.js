Alpine.data('global', () =>({ 
    open: true,
    generateHtml: '<strong>Bold</strong>',
    name: '',
    isShow: true,
    keliatanga: false,
    users: ['punten', 'ucup', 'bebas'],
    apa: [],
    isLoading: false,
    fetchListUser(){
        this.isLoading = true,
        fetch('https://jsonplaceholder.typicode.com/users')
        .then(async (response) => {
            this.apa = await response.json()
            this.isLoading = false
            
        })
    },
    async cobafetch(){
        //kalau pake form data 
        // const formData = new FormData()
        // formData.append('email', 'email@gmail.com')
        // formData.append('password', '123456')

        // body di bawah 
        // body: FormData

        //
        // const formData = (
        //     'email': 'email@gmail.com',
        //     'password': 123456
        // )

    //     const response = fetch('https://jsonplaceholder.typicode.com/users',{
    //         method: 'post',
    //         body: FormData,
    //         headers: {
    //             'authorization':'value'
    //         }
        
    // })

    // this.users= await response.json()
    // this.isLoading = false
    }
    ,
    message: 'Halo',
    pengguna :[
    {
        nama:'diah',
        jenis_kelamin: 'p',
        usia: 15
    },
    {
        nama:'nur',
        jenis_kelamin: 'p',
        usia: 20
    },
    {
        nama:'fulan',
        jenis_kelamin: 'l',
        usia: 50
    },
    {
        nama:'kiki',
        jenis_kelamin: 'l',
        usia: 30
    }]
}))


Alpine.store('darkMode', {
    on:false,

    toggle(){
        this.on = !this.on
    }
})


// fetchLogin(){
//     return localStorage.getItem('email') //manggil
//     localStorage.setItem('email', this.password);
// }

// x-text="localStorage.getItem('email')";

//remove semua yang di localstorage
//pake func clear
//localStorage.clear();

// checkSession(){
//     this.isLogedIn = localStorage.getItem('token') ? true : false
//     if(this.isLogedIn) return window.location.replace(this.baseUrl + 'index.html')
// }