#!/usr/bin/python
# -*- coding: utf-8 -*-

"""
The main screen of the HappyPlants application.
Here the user sees a global overview of all the plant boxes.

Author:         Michelle Ritzema
Last modified:  13 October 2016
"""

import Tkinter as tk
from Tkinter import Frame, Canvas, BOTH, INSIDE
from PIL import Image, ImageTk
from data import ApplicationImages, ApplicationButtons
from views import ImageButton as button


class MainScreen(Frame):

    # Initializes the main screen window frame.
    def __init__(self, parent):
        Frame.__init__(self, parent, background="white")
        self.parent = parent
        self.init_ui()

    # Styles the main screen window frame.
    def init_ui(self):
        self.parent.title("HappyPlants")
        self.pack(fill=BOTH, expand=1)


class MyFrame(tk.Frame):

    def __init__(self, parent):
        tk.Frame.__init__(self, parent)

        screen_width, screen_height = self.winfo_screenwidth(), self.winfo_screenheight()
        application_images = ApplicationImages()
        application_images.add_images(self, screen_width, screen_height)
        images = application_images.images_dictionary

        canvas = Canvas(self, width=screen_width, height=screen_height)
        canvas.pack()

        #needed_images = ["img_background", "img_main_title", "img_main_plant"]
        #collected_images = collect_images(images, needed_images)
        #for image in range(len(collected_images)):
        #    canvas.create_image(collected_images[image][1], collected_images[image][2],
        #                        image=collected_images[image][0])

        button_texts = ['hello']
        for i, button_text in enumerate(button_texts):
            button = tk.Button(text=button_text)
            button.bind("<Button-1>", self.onclick_button)
            canvas.create_window(100, 50 + 30 * i, window=button)

    def onclick_button(self, evt):
        print(evt.widget.cget('text'))


def callback():
    print "click!"


def execute_function():
    print "Quit"


def button_hello(event):
    print "Start new screen..."


def button_quit(event):
    print "Exiting now"
    import sys;
    sys.exit()


# Creates the beginning screen.
# Draws a frame for the buttons, And a canvas with images.
def main():
    root = tk.Tk()
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

    def clicking_button(event):
        print "clicked at", event.x, event.y

    needed_images = ["img_background", "img_main_title", "img_main_plant"]
    collected_images = collect_images(images, needed_images)
    for image in range(len(collected_images)):
        canvas.create_image(collected_images[image][1], collected_images[image][2], image=collected_images[image][0])

    image_button = button.ImageButton(canvas).create_button(buttons["btn_start_yellow"], button_hello, button_quit)
    image_button.pack()
    image_button.place(bordermode=INSIDE, x=int(screen_width - 320), y=int(screen_height - 120))

    image_button = button.ImageButton(canvas).create_button(buttons["btn_start_green"], button_hello, button_quit)
    image_button.pack()
    image_button.place(bordermode=INSIDE, x=int(20), y=int(screen_height - 120))


    root.mainloop()

    #root = Tk()
    #root.title("HappyPlants")
    #make_full_screen(root)
    #MyFrame(root).pack()

    '''
    root = Tk()
    root.title("HappyPlants")
    make_full_screen(root)
    MyFrame(root).pack()
    screen_width, screen_height = root.winfo_screenwidth(), root.winfo_screenheight()
    application_images = ApplicationImages()
    application_images.add_images(root, screen_width, screen_height)
    images = application_images.images_dictionary
    canvas = Canvas(root, width=screen_width, height=screen_height)
    canvas.pack()
    needed_images = ["img_background", "img_main_title", "img_main_plant"]
    collected_images = collect_images(images, needed_images)
    for image in range(len(collected_images)):
        canvas.create_image(collected_images[image][1], collected_images[image][2], image=collected_images[image][0])
    button_texts = ['hello']
    for i, button_text in enumerate(button_texts):
        button = tk.Button(text=button_text)
        #button.bind("<Button-1>", root.onclick_button)
        canvas.create_window(100, 50 + 30 * i, window=button)
    '''

    #root.mainloop()

    '''
    frame_menu = [400, 60]
    frame = Frame(root, width=frame_menu[0], height=frame_menu[1])
    frame.pack(fill='x')

    #c = Canvas(frame, bg='black', width=340, height=frame_menu[1])
    #c.pack()
    #c.create_text(260, 80, text='Canvas', font=('verdana', 10, 'bold'))
    #button1 = Button(frame, text='Start')
    #button1.pack(side='right', padx=10)
    #needed_images = ["btn_start"]
    #collected_images = collect_images(images, needed_images)
    #for image in range(len(collected_images)):
    #    c.create_image(collected_images[image][1], collected_images[image][2], image=collected_images[image][0])

    #b = Button(root, justify=RIGHT)
    #img = Image.open("D:\Desktop\Project\\button_example.png")
    #img = img.resize(300, 100, Image.ANTIALIAS)
    #photo = ImageTk.PhotoImage(img)
    #b.config(image=photo, width="400", height="100")
    #b.pack(side=RIGHT)

    canvas = Canvas(root, width=screen_width, height=screen_height)
    canvas.pack()
    needed_images = ["img_background", "img_main_title", "img_main_plant"]
    collected_images = collect_images(images, needed_images)
    for image in range(len(collected_images)):
        canvas.create_image(collected_images[image][1], collected_images[image][2], image=collected_images[image][0])

    root.mainloop()
    '''

    '''
    root = tk.Tk()
    screen_width, screen_height = root.winfo_screenwidth(), root.winfo_screenheight()
    make_full_screen(root)
    canvas = tk.Canvas(root, width=screen_width, height=screen_height)
    canvas.pack()

    application_images = ApplicationImages()
    application_images.add_images(root, screen_width, screen_height)
    images = application_images.images_dictionary
    needed_images = ["img_background", "img_main_title", "img_main_plant"]
    collected_images = collect_images(images, needed_images)
    for image in range(len(collected_images)):
        canvas.create_image(collected_images[image][1], collected_images[image][2], image=collected_images[image][0])

    root.mainloop()
    '''





# Collects all images that are needed for the current page and returns this list.
def collect_images(images, needed_images):
    collected_images = []
    for index in range(len(needed_images)):
        image_name = needed_images[index]
        try:
            image_information = images[image_name]
            img = Image.open(image_information[0])
            img = img.resize((image_information[1], image_information[2]), Image.ANTIALIAS)
            tk_img = ImageTk.PhotoImage(img)
            collected_images.append([tk_img, image_information[3], image_information[4]])
        except:
            print "Unable to load image"
    return collected_images


def populate_canvas(canvas, images, needed_images):
    for index in range(len(needed_images)):
        image_name = needed_images[index]
        print "image_name: " + str(image_name)
        try:
            image_information = images[image_name]
            print "information: " + str(image_information)
            img = Image.open(image_information[0])
            img = img.resize((image_information[1], image_information[2]), Image.ANTIALIAS)
            tk_img = ImageTk.PhotoImage(img)
            canvas.create_image(image_information[3], image_information[4], image=tk_img)
        except:
            print "Unable to load image"


# Make the window cover the entire screen
def make_full_screen(root):
    root.attributes('-fullscreen', True)
    # root.geometry("%dx%d+0+0" % (width, height))

if __name__ == '__main__':
    main()
