# ordering_study
Web interface for an image ordering user study

[Here](http://mrmartin.net/ordering_study/) is a static demo page, demonstrating the user-end interactivity. This code was used in the user study described in the unpublished paper ''Texture Synthesis User Study'' at EG 2017

## Webpage

The webpage has an introduction page, which saves the user's email, and asks for consent in participating. Then, the user is taken through the 12 textures, each of which has 7 different output images

![screenshot](https://github.com/mrmartin/ordering_study/raw/master/screenshot.png)

The user arranges them by perceived quality, and clicks submit. The created order, original order, and screen parameters are saved into testFile.txt. This requires php with write priviledges

## Analysis

The script raw_to_data.sh selects user study sessions which contain all 12 textures, and converts the file testFile.txt to csv files which can be used for statistical analysis with programs like SPSS. It creates output_order_all_textures_one_row.csv, output_order_by_locations.csv, and meanss.csv

The script contains experiment-specific tuning, for example reversing user #54 who informed us that he made orderings in the opposite order, and removing users #6, #16, #35, #59 who did not spend enough time with the experiment or made no change to the original random orderings.

## Supplementary Material

Along with the web interface, this repository contains supplementary material of the paper ''Texture Synthesis User Study'' at EG 2017.

1. exemplar
  * contains exemplars of the 12 selected textures
2. reference_output
  * contains reference outputs of the 12 selected textures
3. full-resolution method outputs are in folders
  1. Ashikhmin
  2. Sykora (LazyFluids)
  3. self_tuning
  4. CNNMRF
  5. quilting
  6. resynthesizer
4. raw user responses
  * user study ranks.csv
5. texture property tables
  1. binary.csv and binary.xlsx
  2. ordinal.csv and ordinal.xlsx
