/*ใช้ไม่ได้*/
<style>
/* @tailwind base; */
/* @tailwind components; */
/* @tailwind utilities; */

@layer utilities {
  .scrollbar-custom::-webkit-scrollbar {
    width: 10px; /* Width of the entire scrollbar */
  }
  .scrollbar-custom::-webkit-scrollbar-track {
    background: #f1f1f1; /* Color of the track */
    border-radius: 100vh;
  }
  .scrollbar-custom::-webkit-scrollbar-thumb {
    background: #888; /* Color of the draggable handle */
    border-radius: 100vh;
  }
  .scrollbar-custom::-webkit-scrollbar-thumb:hover {
    background: #555; /* Color on hover */
  }

  /* For Firefox */
  .scrollbar-custom {
    scrollbar-width: thin;
    scrollbar-color: #888 #f1f1f1;
  }
}
</style>