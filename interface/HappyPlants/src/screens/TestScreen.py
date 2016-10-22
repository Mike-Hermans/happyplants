"""
The test screen frame of the HappyPlants application.
Shows a test page.

Author:         Michelle Ritzema
Last modified:  22 October 2016
"""

from Tkinter import Frame, Label, Button

TITLE_FONT = ("Helvetica", 18, "bold")


class TestScreen(Frame):
    def __init__(self, parent, controller):
        Frame.__init__(self, parent)
        self.controller = controller
        label = Label(self, text="Test screen", font=TITLE_FONT)
        label.pack(side="top", fill="x", pady=10)
        button = Button(self, text="Go to the splash page", command=lambda: controller.show_frame("SplashScreen"))
        button.pack()
