# laravel broadcast with socket.io and redis #

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## how to install
install nodejs, 
setting redist host in env, if local can use 127.0.0.1

install redist in server
```
sudo apt install redis-server
sudo nano /etc/redis/redis.conf (change bind 127.0.0.1 ::1 ke bind 0.0.0.0 ::1 for remote)
ss -an | grep 6379 (check remote acces)
sudo ufw allow proto tcp from 192.168.121.0/24 to any port 6379 (setting firewell)
redis-cli -h <REDIS_IP_ADDRESS> ping (for check redi server)
sudo systemctl restart redis-server

to start and stop when error
/etc/init.d/redis-server stop
/etc/init.d/redis-server start
```

setting host redis server in laravel
```
open env, change redist host (if isset pass, just fill it)
open laravel-echo-server.json, change host (if isset pass, just fill it)
```


to run echo server
```
laravel-echo-server start
```

if you want run echo server in backround but just can use in linux, can use
```
sudo pm2 start echo-pm2.json
```

migrate the database

```
php artisan migrate
```

run apps
```
php artisan server
http://127.0.0.1:8000/ (for show notification)
http://127.0.0.1:8000/t (for send notification)
```


make new broadcast
```
1.php artisan create:event <nameevent>

2.write 'use App\Events\<nameevent>;' in top controller

3.write '<nameevent>::dispatch();' in controller to make broadcast

4.in <nameevent> file (you can find in app/events), change name class '<nameevent>' to '<nameevent> implements ShouldBroadcast'
  in <nameevent> file (you can find in app/events), in broadcastOn class change 'privatchannel' to 'channel' and give name <namechannel>

5.write in view :
    <script>
            window.laravel_echo_port='{{env("LARAVEL_ECHO_PORT")}}';
    </script>
    <script src="//{{ Request::getHost() }}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js"></script>
    <script src="{{ url('/js/laravel-echo-setup.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        window.Echo.channel("<namechannel>").listen("<nameevent>", (event) => {
            <!-- =>your action<= -->
        });
    </script>
```


