export default function ({ $auth, redirect }) {
  console.log('MIDDLEWARE');
  if (!$auth.loggedIn) {
    redirect('/login')
  }
}
