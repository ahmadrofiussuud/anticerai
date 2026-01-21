from PIL import Image
import os

def remove_black_background(input_path, output_path, threshold=50):
    print(f"Processing {input_path}...")
    try:
        img = Image.open(input_path).convert("RGBA")
        datas = img.getdata()

        newData = []
        for item in datas:
            # item is (R, G, B, A)
            # Check if pixel is close to black
            # Using a slightly higher threshold to catch artifacts
            if item[0] < threshold and item[1] < threshold and item[2] < threshold:
                newData.append((0, 0, 0, 0)) # Fully transparent
            else:
                newData.append(item)

        img.putdata(newData)
        
        # Crop to content to remove excess transparent space
        bbox = img.getbbox()
        if bbox:
            img = img.crop(bbox)
            print(f"Cropped to bounding box: {bbox}")

        img.save(output_path, "PNG")
        print(f"Saved transparent logo to {output_path}")
    except Exception as e:
        print(f"Error processing image: {e}")

input_file = "public/images/logo.png"
output_file = "public/images/logo_transparent.png"

if os.path.exists(input_file):
    remove_black_background(input_file, output_file)
else:
    print(f"Input file not found at {os.path.abspath(input_file)}")
