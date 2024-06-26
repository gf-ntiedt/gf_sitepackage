function handleIntersection(entries) {
    entries.map((entry) => {
        if (entry.isIntersecting) {
            // Item has crossed our observation
            // threshold - load src from data-src
            console.log('isIntersecting');
            console.log('entry', entry);
            if(entry.tagName == 'img'){
                entry.target.src = entry.target.dataset.src;
                entry.target.classList.remove('lazyload');
                entry.target.classList.add('lazyloaded');
            }else{
                entry.target.style.backgroundImage = 'url('+entry.target.dataset.src+')';
                entry.target.classList.remove('lazyload');
                entry.target.classList.add('lazyloaded');
            }
            // Job done for this item - no need to watch it!
            observer.unobserve(entry.target);
        }
    });
}

const items = document.querySelectorAll('.lazyload');
const observer = new IntersectionObserver(handleIntersection);
items.forEach(item => observer.observe(item));

