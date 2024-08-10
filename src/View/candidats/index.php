<style>
    .containers {
        position:absolute;
        top:20%;
        left:5%;
    }

    .img {
        width:50px;
        height:50px;
    }
</style>


<div class="container containers">
    <table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th>Numero</th>
                <th>Nom</th>
                <th>Partie politique</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($candidats as $candidat): ?>
                <tr>
                    <td><img class="img" src="/<?=$candidat['image']?>" alt=""></td>
                    <td><?=$candidat['numero']?></td>
                    <td style="font-weight:bold"><?=$candidat['nom']?></td>
                    <td style="font-weight:bold"><?=$candidat['partie']?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>