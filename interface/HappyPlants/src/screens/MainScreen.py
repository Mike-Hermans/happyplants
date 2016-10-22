from Tkinter import Frame, BOTH


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
