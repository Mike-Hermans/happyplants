

# Contains all button images that can be used in the application.
class ApplicationButtons(object):

    def __init__(self):
        self.button_dictionary = {}

    # Adds all buttons to the button dictionary to be used in the application.
    # The entries are constructed as follows: location, width, height.
    def add_buttons(self):
        self.button_dictionary["btn_start_yellow"] = ["img\ButtonStartYellow.png", int(300), int(100)]
        self.button_dictionary["btn_start_green"] = ["img\ButtonStartGreen.png", int(300), int(100)]
