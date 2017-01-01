#remove lines before experiment started
tail -n +247 raw_testFile.txt > raw_after_start.txt

#find unique sessions, count entries for each
grep " [0-9]* [0-9]* [0-9]* [0-9]* [0-9]* [0-9]* " raw_after_start.txt | sed 's/.* [0-9]*\.[0-9]*\.[0-9]*\.[0-9]* \([a-z0-9]*\) .*/\1/g' | sort | uniq -c | sort -n > unique_sessions.txt

#select usable sessions
grep "^ *12 " unique_sessions.txt > usable_sessions.txt

wc -l usable_sessions.txt

#extract usable data, sorted by session
rm usable_data.txt
i=1; while read line; do grep " [0-9]* [0-9]* [0-9]* [0-9]* [0-9]* [0-9]* " raw_after_start.txt | grep `echo $line | sed 's/.* //g'` | nl -s ' ' | sed 's/^ *//g' | sed "s/^/$i /g" >> usable_data.txt; ((i++)); done < usable_sessions.txt

#anonymise
sed 's/^\([0-9]* [0-9]* [0-9-]* [0-9:]*\) [0-9\.]* \([a-z0-9]* [0-9]* [0-9]* [0-9]* [0-9]* [0-9]* [0-9]* [0-9][a-zA-Z_]* [0-9][a-zA-Z_]* [0-9][a-zA-Z_]* [0-9][a-zA-Z_]* [0-9][a-zA-Z_]* [0-9][a-zA-Z_]* [0-9][a-zA-Z_]*\) .*/\1 \2/g' usable_data.txt > anonymised_data.txt

#get only screen resolutions
sed 's/\([0-9]* [0-9]*\) .* \([0-9]* [0-9]* [0-9]* [0-9]* [0-9]* [0-9]*\) .*/\1 \2/g' anonymised_data.txt > screen_resolutions.txt

#reference - A
#quilting - B
#resynthesizer - C
#self_tuning - D
#Sykora - E
#Ashikhmin - F
#CNNMRF - G

#get reordering info
sed 's/[0-9-]* [0-9:]* [a-z0-9]* [0-9]* [0-9]* [0-9]* [0-9]* [0-9]* [0-9]* //g' anonymised_data.txt | sed 's/[0-9]reference_output/A/g' | sed 's/[0-9]quilting/B/g' | sed 's/[0-9]resynthesizer/C/g' | sed 's/[0-9]self_tuning/D/g' | sed 's/[0-9]Sykora/E/g' | sed 's/[0-9]Ashikhmin/F/g' | sed 's/[0-9]CNNMRF/G/g' > output_order.txt

sed 's/[0-9-]* [0-9:]* [a-z0-9]* [0-9]* [0-9]* [0-9]* [0-9]* [0-9]* [0-9]* //g' anonymised_data.txt | sed 's/[0-9]reference_output/1/g' | sed 's/[0-9]quilting/2/g' | sed 's/[0-9]resynthesizer/3/g' | sed 's/[0-9]self_tuning/4/g' | sed 's/[0-9]Sykora/5/g' | sed 's/[0-9]Ashikhmin/6/g' | sed 's/[0-9]CNNMRF/7/g' > output_order_numeral.txt

#convert output_order_numeral.txt to output_order_by_locations.csv using MATLAB:
/Applications/MATLAB_R2014b.app/bin/matlab -nodisplay -nojvm -r "A=csvread('../../Experiments/texture_experiment_analysis/output_order_numeral.txt');A(A(:,1)==54,3:end)=A(A(:,1)==54,end:-1:3);A(A(:,1)==59,:)=[];A(A(:,1)==35,:)=[];A(A(:,1)==16,:)=[];A(A(:,1)==6,:)=[];[Y,I]=sort(A(:,3:end),2);csvwrite('../../Experiments/texture_experiment_analysis/output_order_by_locations.csv',[A(:,1:2) I]);csvwrite('../../Experiments/texture_experiment_analysis/output_order_all_textures_one_row.csv',[[1:size(I,1)/12]' reshape(I(:,:)',[84 size(I,1)/12])']);csvwrite('means.csv',mean(reshape(I(:,:)',[84 size(I,1)/12])'));exit"

#deprecated, done in MATLAB:
#sed '59d' output_order_all_textures_one_row.csv | sed '54d' | sed '35d' | sed '16d' | sed '6d' > tmp
#mv tmp output_order_all_textures_one_row.csv

#get input order
sed 's/[0-9-]* [0-9:]* [a-z0-9]* [0-9]* [0-9]* [0-9]* [0-9]* [0-9]* [0-9]* //g' anonymised_data.txt | sed 's/\([0-9]\)[a-zA-Z_]*/\1/g' > input_order.txt

#get timings
sed 's/^\([0-9]* [0-9]* [0-9-]* [0-9:]*\) .*/\1/g' anonymised_data.txt | sed 's/\([0-9]\)[a-zA-Z_]*/\1/g' > timings.txt
