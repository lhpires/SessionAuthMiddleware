import './bootstrap';

async function getUser() {
  return await axios.get('http://localhost/api/user').then( (data) => {
      console.log(data);
      alert(data);
  })
};
getUser();
