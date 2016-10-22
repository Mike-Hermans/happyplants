#!/usr/bin/python
# -*- coding: utf-8 -*-

"""
The main class of the HappyPlants application. Here the application
gets started and all important functions, like navigation, is handled.

Author:         Michelle Ritzema
Last modified:  22 October 2016
"""

import sys

from Tkinter import Tk, Frame, INSIDE
from PIL import Image, ImageTk
from views import ImageButton as iButton
from screens import SplashScreen, TestScreen, MainScreen

TITLE_FONT = ("Helvetica", 18, "bold")


# The main function of the application, that starts up everything needed.
class Main(Tk):
    def __init__(self, *args, **kwargs):
        Tk.__init__(self, *args, **kwargs)
        make_full_screen(self)
        container = Frame(self)
        container.pack(side="top", fill="both", expand=True)
        container.grid_rowconfigure(0, weight=1)
        container.grid_columnconfigure(0, weight=1)
        self.frames = {}
        self.initialize_frames(container)
        self.show_frame("SplashScreen")

    # Puts a stack of frames on top of each other.
    def initialize_frames(self, container):
        application_frames = [SplashScreen.SplashScreen, TestScreen.TestScreen, MainScreen.MainScreen]
        for frame in application_frames:
            page_name = frame.__name__
            frame = frame(parent=container, controller=self)
            self.frames[page_name] = frame
            frame.grid(row=0, column=0, sticky="nsew")

    # Show a frame for the given page name by raising it above the other frames
    def show_frame(self, page_name):
        frame = self.frames[page_name]
        frame.tkraise()


# Makes the application window cover the entire screen
# noinspection SpellCheckingInspection
def make_full_screen(root):
    root.attributes('-fullscreen', True)


# Collects all images that are needed for the current page and returns this list.
def collect_images(root, images, needed_images):
    collected_images = []
    root.image_dictionary = {}
    for image in needed_images:
        try:
            image_information = images[image]
            img = Image.open(image_information[0])
            img = img.resize((image_information[1], image_information[2]), Image.ANTIALIAS)
            tk_img = ImageTk.PhotoImage(img)
            root.image_dictionary["{0}".format(image)] = tk_img
            collected_images.append([tk_img, image_information[3], image_information[4]])
        except Exception as exception:
            print "Unable to load image"
            print(exception)
            pass
    return collected_images


# Populates the canvas with all needed images.
def populate_canvas_images(canvas, images):
    for image in range(len(images)):
        canvas.create_image(images[image][1], images[image][2], image=images[image][0])


# Populates the canvas with all needed buttons.
def populate_canvas_buttons(canvas, buttons, needed_buttons, controller):
    for button in needed_buttons:
        image_button = iButton.ImageButton(canvas).create_button(buttons[button[0]], controller, button[1])
        image_button.pack()
        image_button.place(bordermode=INSIDE, x=button[2], y=button[3])


# Prints out a test message.
def button_hello(event):
    print "Start new screen..."
    print event


# Quits the current application.
def quit_application(event):
    print "Exiting now"
    print event
    sys.exit()

if __name__ == "__main__":
    app = Main()
    app.mainloop()
