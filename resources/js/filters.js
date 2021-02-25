
function hideReaded(e) {
    
    const readColllection = document.querySelectorAll(".read");

    readColllection.forEach(read=>read.classList.toggle('d-none'));
  
    if(e.target.innerHTML === 'Show Readed') {
        e.target.innerHTML = 'Hide Readed';
        e.target.classList.add('btn-success');
    } else {
        e.target.innerHTML = 'Show Readed';
        e.target.classList.remove('btn-success');
    }    
 }

function hideArticle(e) {
    const articleColllection = document.querySelectorAll(".article");

    articleColllection.forEach(article=>article.classList.toggle('d-none'));
   
    if(e.target.innerHTML === 'Show Article') {
        e.target.innerHTML = 'Hide Article';
        e.target.classList.add('btn-success');
    } else {
        e.target.innerHTML = 'Show Article';
        e.target.classList.remove('btn-success');
    } 

}

function hideUnread(e) {
    const articleUnreaded = document.querySelectorAll(".unread");

    articleUnreaded.forEach(article=>article.classList.toggle('d-none'));
   
    if(e.target.innerHTML === 'Hide Unreaded') {
        e.target.innerHTML = 'Show Unreaded';
        e.target.classList.remove('btn-success');
    } else {
        e.target.innerHTML = 'Hide Unreaded';
        e.target.classList.add('btn-success');
    } 

}



const buttonHide = document.getElementById('show-readed');
buttonHide.addEventListener('click', hideReaded);


const buttonHideArticle = document.getElementById('show-article');
buttonHideArticle.addEventListener('click', hideArticle);

const buttonUnreaded = document.getElementById('show-unreaded');
buttonUnreaded.addEventListener('click', hideUnread);