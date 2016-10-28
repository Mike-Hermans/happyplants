"""
The splash screen frame of the HappyPlants application.
Shows the very first screen the user sees, with a start button.

Author:         Michelle Ritzema
Last modified:  28 October 2016
"""

from Tkinter import Frame, Canvas
from data import ApplicationImages as DataImg, ApplicationButtons as DataBtn


class SplashScreen(Frame):
    def __init__(self, parent, controller):
        Frame.__init__(self, parent)
        screen_width = self.winfo_screenwidth()
        screen_height = self.winfo_screenheight()
        canvas = Canvas(self, width=screen_width, height=screen_height)
        canvas.pack(side="top", fill="x")
        parent.self.config(cursor='none')
        self.controller = controller
        self.setup_images(screen_width, screen_height, canvas)
        self.setup_buttons(screen_width, screen_height, canvas)

    # Sets up all needed images in the canvas.
    def setup_images(self, screen_width, screen_height, canvas):
        import Main
        application_images = DataImg.ApplicationImages()
        application_images.add_images(screen_width, screen_height)
        images = application_images.images_dictionary
        needed_images = ["img_background", "img_main_title", "img_main_plant"]
        collected_images = Main.collect_images(self, images, needed_images)
        Main.populate_canvas_images(canvas, collected_images)

    # Sets up all needed buttons in the canvas.
    def setup_buttons(self, screen_width, screen_height, canvas):
        import Main
        application_buttons = DataBtn.ApplicationButtons()
        application_buttons.add_buttons()
        buttons = application_buttons.button_dictionary
        needed_buttons = list()
        # needed_buttons.append(["btn_start_green", "TestScreen", 20, int(screen_height - 120)])
        needed_buttons.append(["btn_start_yellow", "MainScreen", int(screen_width - 320), int(screen_height - 120)])
        Main.populate_canvas_buttons(canvas, buttons, needed_buttons, self.controller)
