![DEMO](demo.jpg)

# liteCAPTCHA

**liteCAPTCHA** is a lightweight PHP-based CAPTCHA system that uses images to verify user input. It's a simple and efficient solution for protecting forms from automated submissions. The CAPTCHA prompts users to select specific categories of images (such as cats, dogs, birds, etc.) as verification, ensuring a user-friendly experience.

## Features

- Lightweight and fast CAPTCHA system built with PHP.
- Uses images for human verification.
- Supports various image categories (e.g., animals, objects).
- Easy to integrate into existing PHP projects.
- JSON-based configuration for easy image management.

## Installation

1. **Clone the Repository**  
   Download or clone the liteCAPTCHA repository:
   ```bash
   git clone https://github.com/lowdigital/liteCAPTCHA.git
   ```

2. **Configure Image Data**  
   Edit the `captcha_data.json` file to add or modify the images and their associated categories:
   ```json
   [
     {
       "image": "/captcha/image1.jpg",
       "title": "Cat"
     },
     {
       "image": "/captcha/image2.jpg",
       "title": "Dog"
     },
     {
       "image": "/captcha/image3.jpg",
       "title": "Bird"
     },
     {
       "image": "/captcha/image4.jpg",
       "title": "Fish"
     }
   ]
   ```

3. **Place Your Images**  
   Ensure your image files are correctly placed in the `/captcha/` directory, corresponding to the paths defined in `captcha_data.json`.

4. **Validate User Input**  
   Use `index.php` to validate the user's selection. The script checks whether the user correctly identified the category (e.g., selecting a cat image when prompted).

## Usage

- When the user loads the form, they are shown several images.
- The user is asked to click on an image that matches a specific category (e.g., "Click on all the cat images").
- Upon submission, the system verifies the user's selection using the data from `captcha_data.json`.
- If the selection is correct, the form submission proceeds; otherwise, the user is asked to try again.

## JSON Data Structure

The `captcha_data.json` file contains the following structure:

```json
[
  {
    "image": "/captcha/image1.jpg",
    "title": "Cat"
  },
  {
    "image": "/captcha/image2.jpg",
    "title": "Dog"
  },
  {
    "image": "/captcha/image3.jpg",
    "title": "Bird"
  },
  {
    "image": "/captcha/image4.jpg",
    "title": "Fish"
  }
]
```
- **image**: The relative path to the image.
- **title**: The category or label that the image represents.

## License

This project is licensed under the MIT License.

## Contributing

Feel free to fork the project, create a branch, make your changes, and submit a pull request. Contributions are welcome!

## Author

[@lowdigital](https://t.me/low_digital)
