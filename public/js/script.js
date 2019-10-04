 var app = new Vue({
    el: '#app',
    data:{
      name: 'amine',
      experiences: [],
      open: false,
      experience: {
      	id: 0,
      	cv_id: window.Laravel.idExperience,
      	titre: '',
      	body: '',
      	fin:''
      },
      edit: false
    },
    methods: {
    	getExperirnces: function(){

    	axios.get(window.Laravel.url+'/getexperirnces/'+window.Laravel.idExperience)
    		.then(responce => {
    			this.experiences = responce.data;
    			//console.log('succecss : ', responce)
    		})
    		.catch(error => {
    			console.log('error : ', error)
    		})
    	},
    	addExperience: function() {
    		axios.post(window.Laravel.url+'/addexperience', this.experience)
    		.then(responce => {
    			if (responce.data.etat) {
    				this.open = false;
    				this.experience.id = response.data.id;
    				this.experiences.unshift(this.experience);
    				this.experience = {
    					id: 0,
				      	cv_id: window.Laravel.idExperience,
				      	titre: '',
				      	body: '',
				      	fin:''
				      };
    			}
    		})
    		.catch(error => {
    			console.log(error)
    		})
    	
    },
        editExperience: function(experience) {
          this.open = true;
          this.edit = true;
          this.experience = experience;
    		
    },

    updateExperience: function(experience) {
          axios.put(window.Laravel.url+'/updateexperience', this.experience)
    		.then(responce => {
    			if (responce.data.etat) {
    				this.open = false;
    				this.experience = {
    					id: 0,
				      	cv_id: window.Laravel.idExperience,
				      	titre: '',
				      	body: '',
				      	fin:''
				      };
				      this.edit = false;
    			}
    		})
    		.catch(error => {
    			console.log(error)
    		})
    
    },

    deleteExperience: function(experience) {

    	Swal.fire({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then((result) => {

				  	 axios.delete(window.Laravel.url+'/deleteexperience/'+experience.id)
			    		.then(responce => {
			    			if (responce.data.etat) {
			    				
							 	var position = this.experiences.indexOf(experience);
							 	this.experiences.splice(position, 1);
			    			}
			    		})
			    		.catch(error => {
			    			console.log(error)
			    		})
			  if (result.value) {
			    Swal.fire(
			      'Deleted!',
			      'Your file has been deleted.',
			      'success'
			    )
			  }
			})


   			
 
   		}
    },



    created:function(){
    	this.getExperirnces();
    }
  });
