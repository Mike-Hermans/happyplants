import Tkinter as Tk
from PIL import Image, ImageTk


# Class that creates an image button for the supplied canvas.
# The button's image, width, height, single click action and double click action can be set.
class ImageButton(Tk.Frame):

    def __init__(self, *args, **kwargs):
        Tk.Frame.__init__(self, *args, **kwargs)
        self.image = ""

    # creates a button object with the supplied parameters.
    def create_button(self, button_information, controller, page):
        image = Image.open(button_information[0])
        image = image.resize((button_information[1], button_information[2]), Image.ANTIALIAS)
        self.image = ImageTk.PhotoImage(image)
        button = Tk.Button(self, image=self.image, compound="left", highlightthickness=0, bd=0, command=lambda: controller.show_frame(page))
        button.config(width=button_information[1], height=button_information[2])
        #button.bind('<Button-1>', single_click)
        #button.bind('<Double-1>', double_click)
        button.pack()
        return self
