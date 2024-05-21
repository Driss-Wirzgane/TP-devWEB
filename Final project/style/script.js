document.addEventListener("DOMContentLoaded", function(event) {
    loadProducts();

    document.getElementById('addbutton').addEventListener('click', function() {
        toggleAddProduct();
    });

    document.getElementById('ajouter').addEventListener('click',function() {
        var dev = document.getElementById('addsection');
        dev.scrollIntoView({behavior : "smooth"});
        toggleAddProduct();
    })

    document.getElementById('abtbutton').addEventListener('click', function() {
        var abtSection = document.getElementById('abt');
        var listSection = document.querySelector('.list');
        var abtbutton = document.getElementById('abtbutton');
    
        if (getComputedStyle(abtSection).display === 'none') {
            abtSection.style.display = 'block';
            listSection.style.display = 'none';
            abtbutton.textContent = "return";
        } else {
            abtSection.style.display = 'none';
            listSection.style.display = 'flex';
            abtbutton.textContent = "About Us";
        }
    });

    document.getElementById('valider').addEventListener('click',function(event){
        event.preventDefault();
        let id = document.getElementById('id').value;
        let nom = document.getElementById('nom').value;
        let desc = document.getElementById('desc').value;
        let prix = document.getElementById('prix').value;
        let data = {id:id,nom:nom,desc:desc,price:prix};
        if(id){
            updateProduct(data);
        }else{
            addProduct(data);
        }

    });
});

function loadProducts(){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/Final%20project/db/getProducts.php');

    xhr.onload = () => {
        let data = JSON.parse(xhr.response);
        var products = document.getElementById('products');
        products.replaceChildren();

        for(var d of data){
            var produitDiv = document.createElement('div');
            produitDiv.classList.add('Produit');

            produitDiv.appendChild(document.createElement('h2')).textContent = d.name;
            produitDiv.appendChild(document.createElement('p')).textContent = d.description;
            produitDiv.appendChild(document.createElement('h2')).textContent = d.price + 'DH';
            
            var buttonsdiv = document.createElement('div');
            buttonsdiv.classList.add('buttonDiv');

            var editbutton = document.createElement('button');
            editbutton.id = 'edit';
            editbutton.dataset.obj = JSON.stringify(d);
            editbutton.appendChild(document.createElement('img')).src = 'images/pngaaa.com-5389865.png';
            editbutton.addEventListener('click',function() {
                toggleUpdateProduct();
                var edit = JSON.parse(this.dataset.obj);

                document.getElementById('id').value = edit.id;
                document.getElementById('nom').value = edit.name;
                document.getElementById('desc').value = edit.description;
                document.getElementById('prix').value = edit.price;

                var dev = document.getElementById('addsection');
                dev.scrollIntoView({behavior : "smooth"});
            });
            buttonsdiv.appendChild(editbutton);

            var trashButton = document.createElement('button');
            trashButton.id = 'trash';
            trashButton.dataset.id = d.id;
            trashButton.appendChild(document.createElement('img')).src = 'images/trash-can-icon-png-19.jpg';
            trashButton.addEventListener('click', function() {
                deleteProduct(this.dataset.id);
            });

            buttonsdiv.appendChild(trashButton);
            produitDiv.appendChild(buttonsdiv);
            products.appendChild(produitDiv);
        }
    };

    xhr.onerror = () => {
        console.error('Request failed.');
    };

    xhr.send();
    console.log('Done');
}

function addProduct(data){
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/Final%20project/db/addProduct.php');

    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.responseType = 'json';

    xhr.onload = () => {
        toggleAddProduct();
        loadProducts();
    }
    
    xhr.onerror = () => {
        console.error('Request failed.');
    };

    xhr.send(JSON.stringify(data));
}

function updateProduct(data){
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/Final%20project/db/updateProduct.php');

    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.responseType = 'json';

    xhr.onload = () => {
        toggleAddProduct();
        loadProducts();
    }
    
    xhr.onerror = () => {
        console.error('Request failed.');
    };

    xhr.send(JSON.stringify(data));
}

function deleteProduct(id){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/Final project/db/deleteProduct.php?id='+id);

    xhr.responseType = 'json';

    xhr.onload = () => {
        loadProducts();
    }
    
    xhr.onerror = () => {
        console.error('Request failed.');
    };

    xhr.send();
}

function toggleAddProduct(){
    var form = document.querySelector('.form');
    var addButton = document.getElementById('addbutton');
    
    if (getComputedStyle(form).display === 'none') {
        form.style.display = 'block';
        addButton.style.display = 'none';
        document.getElementById('nom').value = '';
        document.getElementById('desc').value = '';
        document.getElementById('prix').value = '';
    } else {
        form.style.display = 'none';
        addButton.style.display = 'block';
    }
}

function toggleUpdateProduct(){
    var form = document.querySelector('.form');
    var addButton = document.getElementById('addbutton');

    form.style.display = 'block';
    addButton.style.display = 'none';
}