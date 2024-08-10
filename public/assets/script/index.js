const provinces = document.getElementById('provinces')
const regions = document.getElementById('regions')
const districts = document.getElementById('districts')
const communes = document.getElementById('communes')
const fokontany = document.getElementById('fokontany')
const centreDeVotes = document.getElementById('centrevotes')
const bureauDeVote = document.getElementById('bureaudevotes')

const apercu = document.getElementById('hidden')

provinces.addEventListener('change', async () => {
    const data = await recupData(provinces.value, 'provinces')
    regions.innerHTML = ''
    if (Array.isArray(data)) {
        const option = document.createElement('option')
        option.innerHTML = 'Séléctionner une région'
        option.setAttribute('disabled', true)
        regions.appendChild(option)
        data.forEach(region => {
            const option = document.createElement('option')
            option.value = `${region.idRegion}`
            option.innerHTML = `${region.nomRegion}`
            regions.appendChild(option)
        })
        apercu.classList.add('visible')
    }
    else {
        const option = document.createElement('option')
        option.innerHTML = 'Pas de région associée à cette province'
        option.setAttribute('disabled', true)
        regions.appendChild(option)
    }
})


regions.addEventListener('change', async () => {
    const data = await recupData(regions.value, 'regions')
    districts.innerHTML = ''
    if (Array.isArray(data)) {
        const option = document.createElement('option')
        option.innerHTML = 'Séléctionner une district'
        option.setAttribute('disabled', true)
        districts.appendChild(option)
        data.forEach(district => {
            const option = document.createElement('option')
            option.value = `${district.idDistrict}`
            option.innerHTML = `${district.nomDistrict}`
            districts.appendChild(option)
        })
    }
    else {
        const option = document.createElement('option')
        option.innerHTML = 'Pas de district associée à cette province'
        option.setAttribute('disabled', true)
        districts.appendChild(option)
    }
})

districts.addEventListener('change', async () => {
    const data = await recupData(districts.value, 'districts')
    communes.innerHTML = ''
    if (Array.isArray(data)) {
        const option = document.createElement('option')
        option.innerHTML = 'Séléctionner une commune'
        option.setAttribute('disabled', true)
        communes.appendChild(option)
        data.forEach(commune => {
            const option = document.createElement('option')
            option.value = `${commune.idCommune}`
            option.innerHTML = `${commune.nomCommune}`
            communes.appendChild(option)
        })
    }
    else {
        const option = document.createElement('option')
        option.innerHTML = 'Pas de communes associée à cette province'
        option.value = null
        option.setAttribute('disabled', true)
        communes.appendChild(option)
    }
})

communes.addEventListener('change', async () => {
    const data = await recupData(communes.value, 'communes')
    fokontany.innerHTML = ''
    if (Array.isArray(data)) {
        const option = document.createElement('option')
        option.innerHTML = 'Séléctionner une commune'
        option.setAttribute('disabled', true)
        fokontany.appendChild(option)
        data.forEach(fok => {
            const option = document.createElement('option')
            option.value = `${fok.idFokontany}`
            option.innerHTML = `${fok.nomFokontany}`
            fokontany.appendChild(option)
        })
    }
    else {
        const option = document.createElement('option')
        option.innerHTML = 'Pas de fokontany associée à cette province'
        option.setAttribute('disabled', true)
        fokontany.appendChild(option)
    }
})

fokontany.addEventListener('change', async () => {
    const data = await recupData(fokontany.value, 'fokontany')
    centreDeVotes.innerHTML = ''
    console.log(fokontany.value)
    if (Array.isArray(data)) {
        const option = document.createElement('option')
        option.innerHTML = 'Séléctionner une commune'
        option.setAttribute('disabled', true)
        centreDeVotes.appendChild(option)
        data.forEach(centredevote => {
            const option = document.createElement('option')
            option.value = `${centredevote.idCentre}`
            option.innerHTML = `${centredevote.nomCentre}`
            centreDeVotes.appendChild(option)
        })
    }
    else {
        const option = document.createElement('option')
        option.innerHTML = 'Pas de centre de vote associée à ce fokontany'
        option.setAttribute('disabled', true)
        fokontany.appendChild(option)
    }
})

centreDeVotes.addEventListener('change', async () => {
    const data = await recupData(centreDeVotes.value, 'centre')
    bureauDeVote.innerHTML = ''
    console.log(data)
    if (Array.isArray(data)) {
        const option = document.createElement('option')
        option.innerHTML = 'Séléctionner une commune'
        option.setAttribute('disabled', true)
        bureauDeVote.appendChild(option)
        data.forEach(bureau => {
            const option = document.createElement('option')
            option.value = `${bureau.codeBv}`
            option.innerHTML = `${bureau.nomBureau}`
            bureauDeVote.appendChild(option)
        })
    }
    else {
        const option = document.createElement('option')
        option.innerHTML = 'Pas de bureau de vote associé à ce centre'
        option.setAttribute('disabled', true)
        bureauDeVote.appendChild(option)
    }
})



async function recupData (id, goal) {
    const result = await fetch (`http://localhost:8090/API/${goal}.php`, {
        method:'POST',
        headers: {
            'Content-Type': 'text/plain',
        },
        body: JSON.stringify({id:`${id}`})
    })
    if (result.ok) {
        const response = await result.json()
        return response
    }
    else {
        throw new Error ('Erreur de recuperation des données')
    }
}

(async function afficheData () {
    const result = await recupData(4, 'fokontany')
    console.log(result)
})()

/**
 * Pour l'insertion des résultats
 */

