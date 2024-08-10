<style>
    .containers {
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
    }

    .box {
        box-shadow:0 0 5px rgba(0, 0, 0, .5);
        width:400px;
        height:280px;
        border-radius:6px;
        text-decoration:none;
        color:none;
    }

    .box-1 {
        background-color:#BE4304;
        padding:10px 10px;
    }

    .box-2 {
        background-color:#2C03A5;
    }

    .box-3 {
        background-color:#6AB2DC;
    }

    .box img {
        width:50%;
        height:50%;
        margin:10px 0;
    }

    .box h3 {
        color:whitesmoke;
        opacity:0.8;
    }

    .box:hover {
        text-decoration:none;
    }
</style>

<div class="container containers">
    <div class="d-flex align-items-center justify-content-center flex-row gap-3">
        <a href="/Admin/candidats" class="d-flex align-items-center justify-content-center flex-column gap-3 box box-1">
            <img src="/image/icon/4470310.png" alt="">
            <h3>Les candidats</h3>
        </a>
        <a href="/Admin/bureau" class="d-flex align-items-center justify-content-center flex-column mx-5 gap-3 box box-2">
            <img src="/image/icon/11193518.png" alt="">
            <h3>Les bureaux de votes</h3>
        </a>
        <a href="/Admin/users" class="d-flex align-items-center justify-content-center flex-column gap-3 box box-3">
            <img src="/image/icon/utilisateurs.png" alt="">
            <h3>Les utilisateurs</h3>
        </a>
    </div>
</div>