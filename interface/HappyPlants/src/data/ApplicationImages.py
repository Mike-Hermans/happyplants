

# Contains all images that can be used in the application.
class ApplicationImages(object):

    def __init__(self):
        self.images_dictionary = {}

    # Adds all images to the images dictionary to be used in the application.
    # The entries are constructed as follows: location, width, height, horizontal position, vertical position.
    def add_images(self, screen_width, screen_height):
        self.images_dictionary["img_background"] = ["..\img\HappyPlantsBackground.jpg",
                                                    int(screen_width),
                                                    int(screen_height),
                                                    int(screen_width / 2),
                                                    int(screen_height / 2)]
        self.images_dictionary["img_main_title"] = ["..\img\HappyPlantsTitle.png",
                                                    int(screen_width / 1.5),
                                                    int(screen_height / 5.8),
                                                    int(screen_width / 2),
                                                    int(screen_height / 7)]
        self.images_dictionary["img_main_plant"] = ["..\img\HappyPlantsLogo.png",
                                                    int(screen_width / 2),
                                                    int(screen_height / 1.3),
                                                    int(screen_width / 2),
                                                    int(screen_height - (screen_height / 2.8))]
