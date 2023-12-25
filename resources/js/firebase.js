// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getStorage, ref, uploadBytes, uploadString, getDownloadURL } from "firebase/storage";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyAZCqCePggr6ezw4RyTEPdEcC-NJC8qXMg",
  authDomain: "bk2hand-5555f.firebaseapp.com",
  projectId: "bk2hand-5555f",
  storageBucket: "bk2hand-5555f.appspot.com",
  messagingSenderId: "92070423187",
  appId: "1:92070423187:web:54104f712873a85902bb66"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

const storage = getStorage(app);

const storageRef = ref(storage, 'some-child');

const videoRef = ref(storage, 'videos/SampleVideo_720x480_1mb.mp4');

const uploadVideo = async () => {
  const message4 = 'data:text/plain;base64,5b6p5Y+344GX44G+44GX44Gf77yB44GK44KB44Gn44Go44GG77yB';
  const snapshot = await uploadString(storageRef, message4, 'data_url');
  const url = await getDownloadURL(storageRef);
  console.log(url);
}