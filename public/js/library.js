document.addEventListener('DOMContentLoaded',()=>{
  document.querySelectorAll('.save-button').forEach(button=>button.addEventListener('click',()=>{
    const saved=button.classList.toggle('saved');
    button.textContent=saved?'♥':'♡';
    button.setAttribute('aria-pressed',saved?'true':'false');
    button.title=saved?'Remove from saved items':'Save item';
  }));
  document.querySelectorAll('.search-form input').forEach(input=>input.addEventListener('keydown',event=>{
    if(event.key==='Escape'){input.value='';input.blur();}
  }));
});
