<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
</head>
<body>
<div id="app">
    <div class="col-md-12">
        <div class="row">
        <div class="col-md-4">
            <form>
                <input v-model="message" class="form-control" type="text" placeholder="message">
                <button v-on:click="create($event)" class="btn btn-success">send</button>
            </form>
        </div>
        <div class="col-md-8">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">message</th>
                    <th scope="col">created at</th>
                    <th scope="col">updated at</th>
                </tr>
                </thead>
                <tbody>
                <template v-for="(value, key) in list.slice().reverse()">
                    <tr>
                        <th scope="row">@{{value.id}}</th>
                        <td>@{{value.message}}</td>
                        <td>@{{value.created_at}}</td>
                        <td>@{{value.updated_at}}</td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js" integrity="sha512-0qU9M9jfqPw6FKkPafM3gy2CBAvUWnYVOfNPDYKVuRTel1PrciTj+a9P3loJB+j0QmN2Y0JYQmkBBS8W+mbezg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.7.10/vue.min.js"></script>
<script>
    var app = new Vue({
        el : "#app",
        data : {
            'message' : '',
            'list' : []
        },
        created(){
            this.load_mess()
        },
        methods:{
            create(e){
                e.preventDefault()
                var payload = {
                    'message' : this.message
                }
                console.log(payload)
                axios
                    .post('send_message', payload)
                    .then((res)=>{
                        if (res.data.status){
                            this.load_mess();
                            this.message = ""
                            toastr.success("Thêm mesage thành công")
                        } else {
                            toastr.erroe("Thêm mesage lỗi")
                        }
                    })
            },
            load_mess(){
                axios
                    .get('get_mess')
                    .then((res)=>{
                        this.list = res.data.data
                    })
            }
        }
    })
</script>
</html>
