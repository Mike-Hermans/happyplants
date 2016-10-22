#!/usr/bin/python
# -*- coding: utf-8 -*-

"""
The main screen of the HappyPlants application.
Here the user sees a global overview of all the plant boxes.

Author:         Michelle Ritzema
Last modified:  22 October 2016
"""

import sys
import Tkinter

from Tkinter import Frame, Canvas, BOTH, INSIDE
from PIL import Image, ImageTk
from data import ApplicationImages, ApplicationButtons
from views import ImageButton as Button
from screens import MainScreen

TITLE_FONT = ("Helvetica", 18, "bold")


def button_hello(event):
    print "Start new screen..."
    print event


def button_quit(event):
    print "Exiting now"
    print event
    sys.exit()


# Creates the beginning screen.
# Draws a frame for the buttons, And a canvas with images.
def main():
    root = Tkinter.Tk()
    root.title("HappyPlants")
    make_full_screen(root)

    screen_width, screen_height = root.winfo_screenwidth(), root.winfo_screenheight()
    application_images = ApplicationImages.ApplicationImages()
    application_images.add_images(screen_width, screen_height)
    images = application_images.images_dictionary
    application_buttons = ApplicationButtons.ApplicationButtons()
    application_buttons.add_buttons()
    buttons = application_buttons.button_dictionary

    canvas = Canvas(root, width=screen_width, height=screen_height)
    canvas.pack()

    needed_images = ["img_background", "img_main_title", "img_main_plant"]
    collected_images = collect_images(images, needed_images)
    populate_canvas(canvas, collected_images)

    image_button = Button.ImageButton(canvas).create_button(buttons["btn_start_yellow"], button_hello, button_quit)
    image_button.pack()
    image_button.place(bordermode=INSIDE, x=int(screen_width - 320), y=int(screen_height - 120))

    image_button = Button.ImageButton(canvas).create_button(buttons["btn_start_green"], button_hello, button_quit)
    image_button.pack()
    image_button.place(bordermode=INSIDE, x=int(20), y=int(screen_height - 120))

    root.mainloop()


# Collects all images that are needed for the current page and returns this list.
def collect_images(images, needed_images):
    collected_images = []
    for image in needed_images:
        try:
            image_information = images[image]
            img = Image.open(image_information[0])
            img = img.resize((image_information[1], image_information[2]), Image.ANTIALIAS)
            tk_img = ImageTk.PhotoImage(img)
            collected_images.append([tk_img, image_information[3], image_information[4]])
        except Exception as exception:
            print "Unable to load image"
            print(exception)
            pass
    return collected_images


def populate_canvas(canvas, images):
    for image in range(len(images)):
        canvas.create_image(images[image][1], images[image][2], image=images[image][0])


# Make the window cover the entire screen
def make_full_screen(root):
    root.attributes('-fullscreen', True)

if __name__ == '__main__':
    main()
