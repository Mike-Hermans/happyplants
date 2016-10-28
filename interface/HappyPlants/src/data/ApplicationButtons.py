"""
The class containing the application's button information.
Contains all buttons that can be used in the application.

Author:         Michelle Ritzema
Last modified:  28 October 2016
"""


class ApplicationButtons(object):

    def __init__(self):
        self.button_dictionary = {}

    # Adds all buttons to the button dictionary to be used in the application.
    # The entries are constructed as follows: location, width, height.
    def add_buttons(self):
        self.button_dictionary["btn_start_yellow"] = ["img/ButtonStartYellow.png", int(300), int(100)]
        self.button_dictionary["btn_start_green"] = ["img/ButtonStartGreen.png", int(300), int(100)]
