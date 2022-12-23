# Password Storage

## About 

a project since Jun 29, 2021, made purpurcely for own usage, maybe it can become a Saas product, idk anyway:

## Progress

V1
```
made with laravel 8, tailwind for front, a Clipboard and Jquery for displaying data in tables,
. user can register, 
. add Platform if doesnt exist, 
. add Accounts (delete update); when update password, the old password will stay saved
. create a project session to store client's credential, in order to not get overwelmed with too many client's accounts and user accounts
```

V2 
```
. migrated to Laravel 9
. Optimized queries, since it becomes slow when I reached a query that asks for 200 user accounts
. The Optimization problem was just a bad query manipulation, 
. Removed Jquery, Clipboard library 
. Used AlpineJs as a DOM manipulation JS 
```

```
hosted on: Render.com via a docker container



## Techs Used

- **[Laravel](https://laravel.com)**
- **[Tailwind](https://tailwindcss.com)**
- **[AlpineJs](https://alpinejs.dev)**
- **[Clockwork](https://github.com/itsgoingd/clockwork)** for queries benchmarking
