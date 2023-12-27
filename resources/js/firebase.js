// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getStorage, ref, deleteObject, uploadString, getDownloadURL, uploadBytes } from "firebase/storage";
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

document.getElementById('images-input')?.addEventListener('change', event => {
  var input = event.target;
  const imageTemplate = document.getElementById('image-template')
  const imageList = document.getElementById('image-list')

  const generateRandomString = (length = 6) => {
    const charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    let result = "";
    
    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * charset.length);
        result += charset.charAt(randomIndex);
    }
    
    return result;
  }

  const uploadImage = async(data_url, filename) => {
    const imageRef = ref(storage, 'images/' + filename)
    const snapshot = await uploadString(imageRef, data_url, 'data_url')
    const url = await getDownloadURL(imageRef)
    return url
  }

  const deleteImage = async(filename) => {
    await deleteObject(ref(storage, 'images/' + filename))
    console.log("Deleted image");
  }
  
  if (input.files.length) {
      for(const file of input.files) {
          const reader = new FileReader();
          reader.onload = function() {
              if (input.files[0].type.startsWith('image/')) {
                  var clone = document.importNode(imageTemplate.content, true);
                  const cloneId = generateRandomString();
                  clone.querySelector('#templateid').id = cloneId;
                  clone.querySelector('img').src = reader.result;
                  const mediaList = document.getElementById('media-list')
                  clone.querySelector('button').addEventListener('click', function () {
                      // Remove image
                      const clonedImage = document.getElementById(cloneId);
                      imageList.removeChild(clonedImage)
                      deleteImage(cloneId).catch(err => console.log(err))
                      const removeInput = document.getElementById('input' + cloneId)
                      mediaList.removeChild(removeInput)
                      if(imageList.querySelectorAll('div.relative').length == 0) {
                        document.getElementById('trigger-image').style.display = 'flex'
                        document.getElementById('image-list').style.display = 'none'
                      }
                  })
                  imageList.appendChild(clone);
                  //Upload image
                  uploadImage(reader.result, cloneId)
                    .then(url => {
                      // Add url into form
                      const inputTemplate = document.getElementById('input-image-template')
                      var cloneInput = document.importNode(inputTemplate.content, true);
                      cloneInput.querySelector('input').id = 'input' + cloneId
                      cloneInput.querySelector('input').value = url;
                      mediaList.appendChild(cloneInput)
                    })
                    .catch(err => console.log(err))
              }
          }
          reader.readAsDataURL(file)
          document.getElementById('trigger-image').style.display = 'none'
          document.getElementById('image-list').style.display = 'grid'
      }
  }
})

document.getElementById('video-input')?.addEventListener('change', event => {
  var input = event.target
  var videoFile = input.files[0]
  if (videoFile) {
    const videoRef = ref(storage, 'videos/' + videoFile.name)
    const uploadVideo = async (reference, data) => {
      try {
        const snapshot = await uploadBytes(reference, data)
        const url = await getDownloadURL(reference)
        return url
      } catch (err)
      {
        console.log(err)
      }
    }
    uploadVideo(videoRef, videoFile)
    .then(url => {
      console.log("Uploaded video")
      document.getElementById('delete-video-btn').classList.remove('hidden')
      document.getElementById('delete-video-btn')?.addEventListener('click', event => {
        document.getElementById('input-media-video').value = ''
        document.getElementById('video-preview').src = ''
        document.getElementById('video-preview').style.display = 'none'
        document.getElementById('video-icon').style.display = 'block'
        deleteObject(videoRef).then(() => console.log('Deleted video'))
          .catch(err => console.log(err))
      })
      const previewVideo = document.getElementById('video-preview')
      document.getElementById('video-icon').style.display = 'none'
      document.getElementById('delete-video-btn').style.display = 'block'
      previewVideo.src = url
      document.getElementById('input-media-video').value = url
      previewVideo.style.display = 'block'
    })
    .catch(err => console.log(err))
  }
})