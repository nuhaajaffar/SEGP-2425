# Portfolio Optimisation Algorithms 

The codes investigate portfolio optimisation across five major technology equities: Apple, Microsoft, Google, Amazon and Meta. Implementing and evaluating four distinct algorithms: Mean-Variance Optimisation (Markowitz), Particle Swarm Optimisation (PSO), Long Short-Term Memory (LSTM) forecasting, and Reinforcement Learning (RL) with Proximal Policy Optimisation. Each method is assessed on expected return, risk (covariance or Sharpe-ratio based), computational overhead, and adaptability to market dynamics. 

## Installation

To get started with the **Reinforcement Learning Portfolio Management System**, follow these steps:

### Prerequisites

- Python ≥ 3.8
- Google Colab (recommended for running the code) or Jupyter Notebook

### Steps

### Step 1: Download the Project Files
 - Download the project files from Moodle.
 - The files contain the following:
    1. PSO – Particle Swarm Optimisation
    2. Markowitz – Mean Variance Optimisation 
    3. LSTM – Long Short-Term Memory
    4. RL – Reinforcement Learning using PPO

### Step 2: Extract the Files
 - Extract the contents of the zip file to a directory on your system.

### Step 3: Open Google Colab
 - Open Google Colab by navigating to https://colab.research.google.com/.

### Step 4: Upload the Jupyter Notebook File
 - In Colab, upload the Jupyter notebook file of the algorithms codes from the extracted files.

### Step 5: Run the Notebook
 - Once the notebook is uploaded, run all cells in the notebook.

### Step 6: Download the Reports
 - After running the notebook, CSV files containing the cumulative performance of the portfolio 
   for each algorithm (PSO, Markowitz, LSTM, and RL) will be automatically downloaded.

# Warning: YFRateLimitError
 - You might encounter the YFRateLimitError due to hitting the rate limit of the Yahoo Finance API.
 - This issue is outside the control of the system, and the best solution is to wait for a while and try again later.

# Example Output After Running the Notebook:
 - Cumulative Return – The overall percentage return on the portfolio during the testing period.
 - Volatility – The risk level, measured as the standard deviation of returns.
 - Sharpe Ratio – A measure of risk-adjusted return.
 - Max Drawdown – The maximum loss from a peak to a trough during the test period.
 - Cumulative Portfolio Value Plot – A visualization showing the performance of the RL portfolio over time.

# Conclusion:
 Thank you for using the Reinforcement Learning Portfolio Management System!
 We hope it provides valuable insights into portfolio optimization and enhances your understanding of reinforcement learning applied to financial markets.
