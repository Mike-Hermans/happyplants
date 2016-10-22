import sys

from Tkinter import Tk, Frame, Canvas, Label, Button, INSIDE
from PIL import Image, ImageTk
from data import ApplicationImages, ApplicationButtons
from views import ImageButton as iButton

TITLE_FONT = ("Helvetica", 18, "bold")


class Main(Tk):

    def __init__(self, *args, **kwargs):
        Tk.__init__(self, *args, **kwargs)
        make_full_screen(self)
        # The container is where we'll stack a bunch of frames on top of each other,
        # then the one we want visible will be raised above the others
        container = Frame(self)
        container.pack(side="top", fill="both", expand=True)
        container.grid_rowconfigure(0, weight=1)
        container.grid_columnconfigure(0, weight=1)
        self.frames = {}
        for frame in (SplashPage, PageOne, PageTwo):
            page_name = frame.__name__
            frame = frame(parent=container, controller=self)
            self.frames[page_name] = frame
            # Put all of the pages in the same location; the one on the top of
            # the stacking order will be the one that is visible.
            frame.grid(row=0, column=0, sticky="nsew")
        self.show_frame("SplashPage")

    # Show a frame for the given page name
    def show_frame(self, page_name):
        frame = self.frames[page_name]
        frame.tkraise()


class SplashPage(Frame):

    def __init__(self, parent, controller):
        Frame.__init__(self, parent)
        self.controller = controller
        #label = Label(self, text="This is the start page", font=TITLE_FONT)
        #label.pack(side="top", fill="x", pady=10)
        #button1 = Button(self, text="Go to Page One", command=lambda: controller.show_frame("PageOne"))
        #button2 = Button(self, text="Go to Page Two",  command=lambda: controller.show_frame("PageTwo"))
        #button1.pack()
        #button2.pack()

        screen_width, screen_height = self.winfo_screenwidth(), self.winfo_screenheight()
        application_images = ApplicationImages.ApplicationImages()
        application_images.add_images(screen_width, screen_height)
        images = application_images.images_dictionary
        application_buttons = ApplicationButtons.ApplicationButtons()
        application_buttons.add_buttons()
        buttons = application_buttons.button_dictionary

        canvas = Canvas(self, width=screen_width, height=screen_height)
        canvas.pack(side="top", fill="x", pady=10)

        needed_images = ["img_background", "img_main_title", "img_main_plant"]
        collected_images = collect_images(self, images, needed_images)
        populate_canvas(canvas, collected_images)

        image_button = iButton.ImageButton(canvas).create_button(buttons["btn_start_yellow"], button_hello, button_quit)
        image_button.pack()
        image_button.place(bordermode=INSIDE, x=int(screen_width - 320), y=int(screen_height - 120))

        image_button = iButton.ImageButton(canvas).create_button(buttons["btn_start_green"], button_hello, button_quit)
        image_button.pack()
        image_button.place(bordermode=INSIDE, x=int(20), y=int(screen_height - 120))


# Make the window cover the entire screen
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


def populate_canvas(canvas, images):
    for image in range(len(images)):
        canvas.create_image(images[image][1], images[image][2], image=images[image][0])


def button_hello(event):
    print "Start new screen..."
    print event


def button_quit(event):
    print "Exiting now"
    print event
    sys.exit()


class PageOne(Frame):

    def __init__(self, parent, controller):
        Frame.__init__(self, parent)
        self.controller = controller
        label = Label(self, text="This is page 1", font=TITLE_FONT)
        label.pack(side="top", fill="x", pady=10)
        button = Button(self, text="Go to the start page", command=lambda: controller.show_frame("SplashPage"))
        button.pack()


class PageTwo(Frame):

    def __init__(self, parent, controller):
        Frame.__init__(self, parent)
        self.controller = controller
        label = Label(self, text="This is page 2", font=TITLE_FONT)
        label.pack(side="top", fill="x", pady=10)
        button = Button(self, text="Go to the start page", command=lambda: controller.show_frame("SplashPage"))
        button.pack()


if __name__ == "__main__":
    app = Main()
    app.mainloop()
