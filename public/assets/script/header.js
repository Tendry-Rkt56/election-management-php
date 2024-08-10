const selectConn = document.getElementById('header')
const options = document.querySelectorAll('.header-options')
const url = window.location.href

if (options.length !== 0) {
    if (url.includes('/Admin')) {
        options[1].setAttribute("selected", "selected")
    }
    else if (url.includes('/Users')) {
        options[2].setAttribute('selected', 'selected')
    }
}

if (selectConn) {
    selectConn.addEventListener('change', () => {
        const selectedValue = selectConn.value
        if (selectedValue == 'admin') {
            window.location.href = '/Admin/loginView'
        }
        else window.location.href = '/Users/loginView'
    })
}

const formResult = document.getElementById('formResult')
const codeBv = document.getElementById('codeBv')

function _$ (cible) {
    return document.getElementById(cible)
}

console.log(codeBv)

if (codeBv) {
    formResult.style.cssText = `
        visibility:visible;
    `

    const nbrVotants = _$('nombreVotants')
    const voieNull = _$('voieNull')
    const voieBlanche = _$('voieBlanche')
    
    // candidats = []
    // for (let i = 1; i <= 3; i++) {
    //     let voieCandidat = document.querySelector('.candidat-'+i)
    //     candidats.push(voieCandidat)    
    // }

    const candidats = document.querySelectorAll('.candidats')

    console.log(candidats)

    formResult.addEventListener('submit', (e) => {
        const total = parseInt(voieNull.value) + parseInt(voieBlanche.value)
        let totalVoie = 0
        for (let i = 0; i < candidats.length; i++) {
            totalVoie += parseInt(candidats[i].value)
        }
        const totalVotants = totalVoie + total
        if (parseInt(totalVotants) != parseInt(nbrVotants.value)) {
            alert(`Erreur dans les données!  
            nombresVotants: ${totalVotants} Total: ${nbrVotants.value}`)
            e.preventDefault()
            console.log(nbrVotants.value)
        }
    })
    
}

const containerNavigation = document.querySelector('.container-navigation')
const navigation = document.getElementById('navigation')

if (navigation) {
    navigation.addEventListener('click', (e) => {
        containerNavigation.classList.toggle('actives')
    })
}

