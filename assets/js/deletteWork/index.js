 
class DeletteWork {
    constructor() {
      this.init()
    }
  
    init() { 
     
      const BtnsToDelette = document.querySelectorAll('#deletteWorkFromListPage');
         
       
      if ('object' == typeof BtnsToDelette) {
        BtnsToDelette.forEach((BtnToDelette) => {
          BtnToDelette.addEventListener('click', (e) => { 
            e.preventDefault(); 
              const URLToDelette = e?.currentTarget?.href + '&type=delette';
              let confirmDelettePost = prompt('Please tipe WORK to delette')
              if ( confirmDelettePost && confirmDelettePost.toLowerCase() === 'work' ) {
                window.location.href = URLToDelette
              } else {
                console.warn(
                  'the work id: ' +
                  e.target.href.split('=')[1] +
                    ' not has been deletted',
                )
              }
            
          })
        })
        
  
  
      }}
    }
  
  
  export default DeletteWork
  