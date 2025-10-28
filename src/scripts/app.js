// app.js — nav, mobile drawer, and simple tabs
(function(){
// Mobile drawer
const menuBtn = document.querySelector('#menuBtn');
const drawer = document.querySelector('#mobileDrawer');
if(menuBtn && drawer){
menuBtn.addEventListener('click',()=>drawer.classList.toggle('open'));
}
// Active nav link
const here = location.pathname.split('/').pop() || 'index.html';
document.querySelectorAll('nav .links a, .mobile-drawer a').forEach(a=>{
const href = a.getAttribute('href');
if(href === here || (here === 'index.html' && (href === '/' || href === 'index.html'))){
a.setAttribute('aria-current','page');
}
});
// Tabs (games page)
const tablist = document.querySelector('[role="tablist"]');
if (tablist){
const tabs = tablist.querySelectorAll('[role="tab"]');
const panels = document.querySelectorAll('[role="tabpanel"]');
function selectTab(id){
tabs.forEach(t=>t.setAttribute('aria-selected', String(t.id===id)));
panels.forEach(p=>{
p.classList.toggle('active', p.getAttribute('aria-labelledby')===id);
});
}
tabs.forEach(t=>t.addEventListener('click',()=>selectTab(t.id)));
// default first
if (tabs[0]) selectTab(tabs[0].id);
}
})();