<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div id="notification"></div>
    <div class="container" id="appVue">
        <table class="table">
            <tr>
                <td>id</td>
                <td>long</td>
                <td>lat</td>
            </tr>
            {{-- @foreach ($data as $row)
                <tr>
                    <td>{{ $row->user }}</td>
                    <td>{{ $row->longitude }}</td>
                    <td>{{ $row->latitude }}</td>
                </tr>
            @endforeach --}}

            <tr v-for="(item,index) in data_koordinat">
                {{-- <td>@{{ index + 1 }}</td> --}}
                <td>@{{ item.user }}</td>
                <td>@{{ item.longitude }}</td>
                <td>@{{ item.latitude }}</td>
            </tr>

        </table>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var vueDataKoordinat = new Vue({
            el: "#appVue",
            data: {
                data_koordinat: []
            },
            mounted() {
                this.getData();
            },
            methods: {
                getData: function() {
                    let url = "{{ url('lokasi') }}";
                    axios.get(url)
                        .then(resp => {
                            // console.log(resp);
                            this.data_koordinat = resp.data.data;
                        })
                        .catch(err => {
                            console.log(err);
                            alert('error');
                        })
                }
            }
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

  
    <script>
            window.laravel_echo_port='{{env("LARAVEL_ECHO_PORT")}}';
    </script>
    <script src="//{{ env("LARAVEL_ECHO_HOST") }}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js"></script>
    <script src="{{ url('/js/laravel-echo-setup.js') }}" type="text/javascript"></script>
    
    <script type="text/javascript">
        // window.Echo.channel('user-channel')
        // .listen('.UserEvent', (data) => {
        //     vueDataKoordinat.getData();
        // });
        
        window.Echo.channel("messages").listen("send_koordinat", (event) => {
            vueDataKoordinat.getData();
        });
    </script>

</html>