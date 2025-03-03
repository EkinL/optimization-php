import os
from PIL import Image

def convert_images_to_webp(input_folder, output_folder, quality=80):
    """
    Convertit toutes les images d'un dossier en WebP avec compression et les enregistre dans un dossier de sortie.

    :param input_folder: Dossier contenant les images à convertir.
    :param output_folder: Dossier où enregistrer les images compressées.
    :param quality: Qualité de compression (0-100, 80 recommandé).
    """
    # Vérifier si le dossier d'entrée existe
    if not os.path.exists(input_folder):
        print(f"❌ Erreur : Le dossier source '{input_folder}' n'existe pas.")
        return
    
    # Créer le dossier de sortie s'il n'existe pas
    if not os.path.exists(output_folder):
        os.makedirs(output_folder)

    # Extensions d'image prises en charge
    valid_extensions = ('.jpg', '.jpeg', '.png', '.bmp', '.tiff')

    # Parcourir tous les fichiers du dossier
    for filename in os.listdir(input_folder):
        file_path = os.path.join(input_folder, filename)

        # Vérifier si c'est une image valide
        if filename.lower().endswith(valid_extensions):
            try:
                # Ouvrir l'image avec Pillow
                with Image.open(file_path) as img:
                    # Construire le chemin de sortie
                    output_path = os.path.join(output_folder, os.path.splitext(filename)[0] + ".webp")
                    
                    # Convertir et sauvegarder en WebP avec compression
                    img.save(output_path, "WEBP", quality=quality)
                    print(f"✅ {filename} → {output_path}")
            except Exception as e:
                print(f"❌ Erreur avec {filename}: {e}")
        else:
            print(f"⚠ Ignoré: {filename} (ce n'est pas une image valide)")

# Définir les chemins d'entrée et de sortie
input_folder = "/Users/lilian/Downloads/optimization-php/app/assets/img"
output_folder = "/Users/lilian/Downloads/optimization-php/app/assets/img_webp"

# Lancer la conversion
convert_images_to_webp(input_folder, output_folder)