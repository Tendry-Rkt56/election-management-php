
<style>
    .containers {
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
    }
</style>
<div style="text-align:center;" class="containers alert alert-danger container-sm d-flex align-items-center justify-content-center flex-column">
    <h4 class="d-flex align-items-center justif-content-center"><?=$_GET['error']?></h2>
    <h5>Le nombre de votants est: <span style="font-weight:bold;"><?=$_GET['nombreVotants']?></span></h5>
    <h5>Le nombre d'élécteurs est: <span style="font-weight:bold;"><?=$_GET['nombreElecteurs']?></span></h5>
    <a href="/Users/resultForm" class="my-3 btn btn-primary">Retour</a>
</div>